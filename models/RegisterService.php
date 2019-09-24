<?php


namespace app\models;


use DomainException;
use Exception;
use RuntimeException;
use Yii;

class RegisterService
{

    /**
     * Register new user in DB
     * @param RegisterForm $form
     * @return User
     */
    public function singup(RegisterForm $form)
    {
        $user = new User();
        $vote = new Vote();

        $user_transaction = User::getDb()->beginTransaction();
        $vote_transaction = Vote::getDb()->beginTransaction();

        try {
            // load data
            if ($user->load($form->getUserArray())) {
                if ($vote->load($form->getVoteArray())) {
                    if ($user->save()) {
                        $vote->user_id = $user->id;
                        if ($vote->save()) {
                            $user_transaction->commit();
                            $vote_transaction->commit();
                            return $user;
                        }
                    }
                }
            }

            $user_transaction->rollBack();
            $vote_transaction->rollBack();
            throw new RuntimeException('Saving error.');

        } catch (Exception $e) {
            $user_transaction->rollBack();
            $vote_transaction->rollBack();
            throw new RuntimeException('Saving error.');
        }
    }

    public function sendEmail(User $user)
    {
        $send = Yii::$app->mailer
            ->compose(['html' => 'verify'],['user' => $user])
            ->setTo($user->email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('Подтверждение регистрации')
            ->send();
        if (!$send)
            throw new RuntimeException('Send mail error');
    }

    public function confirmation($token)
    {
        if (empty($token))
            throw new DomainException('Empty confirm token.');

        $user = User::findOne(['email_confirm_token' => $token]);
        if (!$user)
            throw new DomainException('User is not found');

        $transaction = User::getDb()->beginTransaction();
        try {
            $user->email_confirm_token = null;
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                $transaction->commit();
                return true;
            }
            throw new RuntimeException('Saving error.');
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new RuntimeException('Saving error.');
        }
    }
}