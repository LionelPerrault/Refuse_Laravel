<?php



namespace App;
use App\Model\GoalsReached;
use Illuminate\Database\Eloquent\Model;

class goal_attribute extends Model
{
    public function goals()
    {
        return $this->hasMany(GoalsReached::class);
    }
}
