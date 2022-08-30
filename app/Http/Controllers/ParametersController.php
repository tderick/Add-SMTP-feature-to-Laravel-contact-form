<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameters;

class ParametersController extends Controller
{

    public function index()
    {

        $parameters = Parameters::where('id', 1)->first();
        return view('parameters', compact('parameters'));
    }

    public function save_parameter(Request $request)
    {
        if (isset($request->all()['email-notification'])) {
            $data['is_email_notification_actived'] = 1;
            Parameters::where('id', 1)->update($data);
        } else {
            $data['is_email_notification_actived'] = 0;
            Parameters::where('id', 1)->update($data);
        }

        return redirect("/admin/settings")->with("status", "Your parameters have been saved");;
    }
}
