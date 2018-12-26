<?php 
    namespace app\components; 
    use yii\base\Widget; 

    class FirstWidget extends Widget { 
        public $mes; 
        public function init() { 
            parent::init(); 
            if ($this->mes === null) { 
                $this->mes = 'First Widget'; 
            }
            ob_start();
        }  
        public function run() {
            $content = ob_get_clean();
            return "<h1>$this->mes<br>$content</h1>"; 
        } 
    } 
?>
