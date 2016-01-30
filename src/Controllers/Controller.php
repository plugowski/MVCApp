<?php
namespace MyApp\Controllers;

/**
 * Class Controller
 * @package MyApp\Controllers
 */
class Controller
{
    /**
     * @var bool
     */
    protected $render = true;
    /**
     * @var string
     */
    protected $template;
    /**
     * @var static
     */
    protected $f3;

    public function __construct()
    {
        $this->f3 = \Base::instance();
    }

    /**
     * Auto-generated template name based on class name and called method
     * @return string
     * @throws \Exception
     */
    private function templateFromRoute()
    {
        $path = $this->f3->get('PATH');
        $routes = $this->f3->get('ROUTES');
        $requestType = $this->f3->get('VERB');
        $calledMethod = current($routes[$path])[$requestType][0];

        if (false == preg_match('/(?:.+\\\)(?<controller>.+)Controller(?:->|::)(?<method>.+)/', $calledMethod, $match)) {
           return null;
        }

        $template = $match['controller'] . '/' . $match['method'] . '.xhtml';
        if (file_exists(__DIR__ . '/../Views/' . $template)) {
            return $template;
        } else {
            throw new \Exception(sprintf('Template: %s not found!', $template));
        }
    }

    /**
     * Set variables for template
     * @param string|array $var
     * @param mixed|null $value
     */
    protected function set($var, $value = null)
    {
        if (is_array($var)) {
            foreach ($var as $name => $value) {
                $this->f3->set($name, $value);
            }
        } else {
            $this->f3->set($var, $value);
        }
    }

    /**
     * After controller finished all logic, render view
     */
    public function __destruct()
    {
        if (false === $this->render) {
            return true;
        }

        if (is_null($this->template)) {
            $this->template = $this->templateFromRoute();
        }

        $this->f3->set('content', $this->template);
        echo \Template::instance()->render('layout.xhtml');
    }
}