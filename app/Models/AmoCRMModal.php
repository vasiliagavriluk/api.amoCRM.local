<?php

namespace App\Models;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\BadTypeException;
use AmoCRM\Filters\CompaniesFilter;
use AmoCRM\Models\CompanyModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\OAuth2\Client\Token\AccessTokenInterface;


class AmoCRMModal extends Model
{
    use HasFactory;

    private AmoCRMApiClient $apiClient;
    private string $state;

    /**
     * @throws \Exception
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->state = bin2hex(random_bytes(16));
        $this->apiClient = new AmoCRMApiClient(
            config('services.amocrm.client_id'),
            config('services.amocrm.client_secret'),
            config('services.amocrm.client_redirect_url'));
    }

    /**
     * @throws BadTypeException
     */
    public function getAuthButton(): string
    {
       return $this->apiClient->getOAuthClient()->getOAuthButton(
            [
                'title' => 'Установить интеграцию',
                'compact' => true,
                'class_name' => 'className',
                'color' => 'default',
                'error_callback' => 'handleOauthError',
                'state' => $this->state,
                'mode'=>'popup'
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function getAuthorize(): string
    {
        $state = bin2hex(random_bytes(16));

        return $this->apiClient->getOAuthClient()->getAuthorizeUrl([
            'state' => $state,
            'mode' => 'popup', //post_message - редирект произойдет в открытом окне, popup - редирект произойдет в окне родителе
        ]);

    }

    /**
     * @throws AmoCRMoAuthApiException
     */
    public function accessToken($code): AccessTokenInterface
    {
        $this->apiClient->setAccountBaseDomain(config('services.amocrm.client_base_domain')); //
        $accessToken = $this->apiClient->getOAuthClient()->getAccessTokenByCode($code);
        $this->apiClient->setAccessToken($accessToken)
            ->setAccountBaseDomain(config('services.amocrm.client_base_domain'))
            ->onAccessTokenRefresh(
                function (AccessTokenInterface $accessToken, string $baseDomain) {
                    saveToken(
                        [
                            'accessToken' => $accessToken->getToken(),
                            'refreshToken' => $accessToken->getRefreshToken(),
                            'expires' => $accessToken->getExpires(),
                            'baseDomain' => $baseDomain,
                        ]
                    );
                });

        return $accessToken;

    }

    /**
     * @throws AmoCRMApiException
     * @throws AmoCRMMissedTokenException
     * @throws AmoCRMoAuthApiException

            $contacts = $this->apiClient->contacts($item->accountId)->get()->all();
            $name =  $contacts[0]->name;
     *  */

    public function getAccount(): bool
    {
        $account[] = $this->apiClient->account()->getCurrent();
        foreach ($account as $item)
        {
            if (!Account::where('account_id', '=', $item->id)->first()) {
                $value =
                    [
                        'account_id'       => $item->id,
                        'name'             => $item->name,
                        'subdomain'        => $item->subdomain,
                        'currentUser_id'   => $item->currentUserId, #getUsers->id
                    ];
                $result = (new Account())->create($value); //запись в бд
            }
        }
        return true;
    }

    public function getUsers() #Получение списка пользователей
    {
        $users = $this->apiClient->users()->get()->all();
        foreach ($users as $item)
        {
            if (!Users::where('users_id', '=', $item->id)->first())
            {
                $value =
                    [
                        'users_id'           => $item->id,
                        'name'               => $item->name,
                        'email'              => $item->email,
                        'lang'               => $item->lang,
                    ];
                $result = (new Users())->create($value); //запись в бд
            }

        }
        return true;
        #id: 8860711
        #name: "Гаврилюк Василий"
        #email: "gavrilyuk.vasja@gmail.com"
        #lang: "ru"

    }

    public function getContacts() #Получение списка пользователей
    {
        $users = $this->apiClient->contacts()->get()->all();
        foreach ($users as $item)
        {
            if (!Contacts::where('contacts_id', '=', $item->id)->first())
            {
                $value =
                    [
                        'contacts_id'            => $item->id,
                        'name'                   => $item->name,
                        'firstName'              => $item->firstName,
                        'lastName'               => $item->lastName,
                        'accountId'              => $item->accountId,
                    ];
                $result = (new Contacts())->create($value); //запись в бд
            }

        }
        return true;
        #id: 12795
        #name: "Василий Гаврилюк"
        #firstName: "Василий"
        #lastName: "Гаврилюк"
        #accountId: 30636205
    }


    /**
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws AmoCRMMissedTokenException
     */
    public function getCompanies() # Получение списка компаний
    {

        $companies = $this->apiClient->companies()->get()->all();

        foreach ($companies as $item)
        {
            if (!Companies::where('companies_id', '=', $item->id)->first()) {
                $value =
                    [
                        'companies_id'       => $item->id,
                        'name'               => $item->name,
                        'responsibleUserId'  => $item->responsibleUserId,
                        'account_Id'          => $item->accountId,
                    ];
                $result = (new Companies())->create($value); //запись в бд
            }

        }
        return true;
        #id: 12793
        #name: "Тест"
        #responsibleUserId: 8860711
        #accountId: 30636205
    }

    public function getPipelines() # Получение списка Воронок
    {
        $pipelines = $this->apiClient->pipelines()->get()->all();
        $result = [];
        foreach ($pipelines as $item)
        {
            if (!Pipeline::where('pipe_id', '=', $item->id)->first())
            {
                $value =
                    [
                        'pipe_id'            => $item->id,
                        'name'               => $item->name,
                        'account_Id'         => $item->accountId,
                    ];
                (new Pipeline())->create($value); //запись в бд
            }

            $result[] = ['id' => $item->id,];
        }
        return $result;


            #id: 6081808
            #name: "Воронка"
            #sort: 1
            #accountId: 30636205

    }

    public function getStatuses($id) #id воронки
    {
        $statuses = $this->apiClient->statuses($id)->get()->all();

        foreach ($statuses as $item)
        {
            if (!Statuses::where('statuses_id', '=', $item->id)->first())
            {
                $value =
                    [
                        'statuses_id'        => $item->id,
                        'name'               => $item->name,
                        'color'              => $item->color,
                    ];
                $result = (new Statuses())->create($value); //запись в бд
            }

        }

            #id: 52733473
            #name: "Неразобранное"
            #accountId: 30636205
            #color: "#c1c1c1"
            #pipelineId: 6081808
    }

    public function getLeads() # Получение списка сделок  +
    {
        $leads = $this->apiClient->leads()->get()->all();

        foreach ($leads as $item)
        {
            if (!Leads::where('leads_id', '=', $item->id)->first())
            {
                $value =
                    [
                        'leads_id'           => $item->id,
                        'name'               => $item->name,
                        'price'              => $item->price,
                        'responsibleUser_Id' => $item->responsibleUserId,
                        'group_Id'           => $item->groupId,
                        'account_Id'         => $item->accountId,
                        'pipeline_Id'        => $item->pipelineId,
                        'status_Id'          => $item->statusId,
                        'company_id'         => $item->company->id
                    ];
                $result = (new Leads())->create($value); //запись в бд
            }
        }
        return true;
    }

    /**
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws AmoCRMMissedTokenException
     */
    public function getAll()
    {
        $Account =      $this->getAccount();
        $Users =        $this->getUsers();
        $contact =      $this->getContacts();
        $Companies =    $this->getCompanies();
        $id_Pipelines = $this->getPipelines();

        foreach ($id_Pipelines as $item)
        {
           $this->getStatuses($item['id']);
        }
        $item = $this->getLeads();

    }




}
