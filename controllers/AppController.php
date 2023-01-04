<?php
/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: $file.created
 * 6/30/22, 10:44 PM
 * Last Modified at: 6/30/22, 10:44 PM
 * Time: 10:44
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */

namespace app\controllers;

use app\models\ContactModel;
use wizarphics\wizarframework\Controller;
use wizarphics\wizarframework\http\Request;
use wizarphics\wizarframework\http\Response;

class AppController extends Controller
{
    public function home()
    {
        return $this->render('index');
    }

    public function about()
    {
        return $this->render('about');
    }

    public function talk()
    {
        return $this->render('contact', [
            'model' => new ContactModel()
        ]);
    }

    public function talkForm(Request $request, Response $response)
    {
        $contact = new ContactModel();
        $contact->loadData($request->postData([
            'name', 'companyName', 'companyEmail', 'phone', 'message'
        ]));
        if ($contact->validate()) {
            session()->setFlash('success', 'Thanks for contacting us. we will contact you soon.');
            return redirect(route_to('talk'));
        } else {
            session()->setFlash('error', 'There was an error contacting us.');
            return $this->render('contact', [
                'model' => new ContactModel()
            ]);
        };
    }
}
