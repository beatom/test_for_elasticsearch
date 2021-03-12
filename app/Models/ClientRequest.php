<?php

namespace App\Models;

use App\Mail\NewClientRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

/**
 * @mixin Builder
 */
class ClientRequest extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * Creating new client requests
     *
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     *
     * @return boolean
     */
    public static function addRequest($email, $first_name, $last_name)
    {
        $record = new static();
        $record->email = $email;
        $record->first_name = $first_name;
        $record->last_name = $last_name;
        if (!$record->save()) {
            return false;
        }


        $record->addToQueue();
        return true;
    }


    /**
     * Adding new message to Mail queue
     */
    public function addToQueue()
    {
        Mail::queue(new NewClientRequest($this));

        $this->send = true;
        $this->save();
        return true;
    }

}
