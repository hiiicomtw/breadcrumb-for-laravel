<?php

namespace Hiiicomtw\Breadcrumb;

class Breadcrumb
{

    private $callbacks = [];
    private $breadcrumbs = [];
    private $template;

    /**
     * Add a title and a URL into the breadcrumbs.
     *
     * @param      $title
     * @param null $url
     */
    public function add($title, $url = null)
    {
        $this->breadcrumbs[] = (object) [
            'title' => $title,
            'url' => $url
        ];
    }

    /**
     * Define a breadcrumb.
     *
     * @param string   $name
     * @param Callable $callback
     *
     * @throws FileNotFoundException
     */
    public function define($name, $callback)
    {
        if (array_key_exists($name, $this->callbacks)) {
            throw new FileNotFoundException("The breadcrumb ($name) has been defined.");
        }

        $this->callbacks[$name] = $callback;
    }

    /**
     * Render the breadcrumb.
     *
     * @param $name
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws FileNotFoundException
     */
    public function render($name)
    {
        if (!array_key_exists($name, $this->callbacks)) {
            if (config('breadcrumb.ignore-undefined-breadcrumb', false)) {
                return null;
            }

            throw new FileNotFoundException("Breadcrumb $name is not found.");
        }

        $parameters = array_slice(func_get_args(), 1);

        $breadcrumbs = $this->generate($name, $parameters);

        return $this->renderView($breadcrumbs);
    }

    /**
     * Setting the template to be used.
     *
     * @param $name
     *
     * @return $this
     */
    public function setTemplate($name)
    {
        $this->template = $name;

        return $this;
    }

    /**
     * Generate the breadcrumb.
     *
     * @param string $name
     * @param array  $parameters
     *
     * @return array
     */
    private function generate($name, $parameters)
    {
        $this->breadcrumbs = [];

        array_unshift($parameters, $this);

        call_user_func_array($this->callbacks[$name], $parameters);

        return $this->breadcrumbs;
    }

    /**
     * Render the breadcrumb into the template.
     *
     * @param $breadcrumbs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function renderView($breadcrumbs)
    {
        return view($this->template, compact('breadcrumbs'));
    }
}