<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ValidatedRequest;
class AuthorizedRequest extends ValidatedRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $route = $this->route()->getName();
        if (!isset($authorize[$route])) {
            return true;
        }
        $authorizePath = resource_path('defaults/authorize.json');
        $authorize = file_exists($authorizePath) ? json_decode(file_get_contents($authorizePath), true) : ['roles' => [], 'permissions' => []];
        $authorizedRole = isset($authorize[$route]['roles']) ? count($authorize[$route]['roles']) == 0 : true;
        $authorizedPermission = isset($authorize[$route]['permissions']) ? count($authorize[$route]['permissions']) == 0 : true;
        if ($this->user() && isset($authorize[$route])) {
            if (!$authorizedRole) {
                foreach ($authorize[$route]['roles'] as $role) {
                    if ($this->user()->hasRole($role)) {
                        $authorizedRole = true;
                        break;
                    }
                }
            }
            if (!$authorizedPermission) {
                foreach ($authorize[$route]['permissions'] as $permission) {
                    if ($this->user()->can($permission)) {
                        $authorizedPermission = true;
                        break;
                    }
                }
            }
        }
        return $authorizedRole || $authorizedPermission;
    }
}