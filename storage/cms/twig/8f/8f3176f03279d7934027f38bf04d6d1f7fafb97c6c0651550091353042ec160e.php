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

/* /var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/scrollingNavbar.htm */
class __TwigTemplate_625cc376d42f92dd1dd05b377b157b95611ada554a0e7f713ba67c2c3d197ab8 extends \Twig\Template
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
        echo "<!--Navbar-->
<nav class=\"navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar\">

    <!-- Navbar brand -->
    <a class=\"navbar-brand\" href=\"#\">LOGO</a>

    <!-- Collapse button -->
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\"
        aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>

    <!-- Collapsible content -->
    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
        ";
        // line 13
        if (twig_get_attribute($this->env, $this->source, ($context["staticMenu"] ?? null), "menuItems", [], "any", false, false, false, 13)) {
            // line 14
            echo "            ";
            $context["items"] = twig_get_attribute($this->env, $this->source, ($context["staticMenu"] ?? null), "menuItems", [], "any", false, false, false, 14);
            // line 15
            echo "        <!-- Links -->

        ";
        }
        // line 18
        echo "        <!-- Links -->
    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->";
    }

    public function getTemplateName()
    {
        return "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/scrollingNavbar.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 18,  56 => 15,  53 => 14,  51 => 13,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!--Navbar-->
<nav class=\"navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar\">

    <!-- Navbar brand -->
    <a class=\"navbar-brand\" href=\"#\">LOGO</a>

    <!-- Collapse button -->
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\"
        aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>

    <!-- Collapsible content -->
    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
        {% if staticMenu.menuItems %}
            {% set items = staticMenu.menuItems %}
        <!-- Links -->

        {% endif %}
        <!-- Links -->
    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->", "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/scrollingNavbar.htm", "");
    }
}
