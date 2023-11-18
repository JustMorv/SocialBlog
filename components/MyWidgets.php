<?
namespace app\components;
use yii\base\Widget;
class MyWidgets extends  Widget
{
    public $name;
    public function init(){
        parent::init();
        if($this->name == null) $this->name = "host";
    }
    public function run(){
        return $this->render("my", [
            "name" => $this->name ]);
    }
    
}
