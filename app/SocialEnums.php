<?php

namespace App;

enum SocialEnums: string
{
    case STATUS_SUCCESS = 'success';

    case STATUS_ERROR = 'error';

    case STATUS_REGISTER = 'user_register';

    case STATUS_MAIL_EXIST = 'mail_exist';

    case ROUTE_REGISTER = 'register';

    case ROUTE_DASHBOARD = 'dashboard';

    case ROUTE_LOGIN = 'login';
}
