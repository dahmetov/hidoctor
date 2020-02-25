<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/footer/4-column.htm */
class __TwigTemplate_e664325cd52062f2432ebd58e59220b2c6cf45b1ef348aa1389566c5233fb3cb extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!--Footer-->
<footer class=\"page-footer font-small blue\" style=\"padding-top: 0\">
    <!--Copyright-->
    <div class=\"footer-copyright text-center py-3\">
        © ";
        // line 5
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " Copyright: <a href=\"#\"> HI Doctor </a>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->";
    }

    public function getTemplateName()
    {
        return "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/footer/4-column.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!--Footer-->
<footer class=\"page-footer font-small blue\" style=\"padding-top: 0\">
    <!--Copyright-->
    <div class=\"footer-copyright text-center py-3\">
        © {{ 'now'|date('Y') }} Copyright: <a href=\"#\"> HI Doctor </a>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->", "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/footer/4-column.htm", "");
    }
}
