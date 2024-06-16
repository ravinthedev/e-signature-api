<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureRequest extends Model
{
    use HasFactory;

    protected $fillable = ['document_id', 'requester_id', 'signer_id', 'status'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function signer()
    {
        return $this->belongsTo(User::class, 'signer_id');
    }
}
