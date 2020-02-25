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

/* /var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/head.htm */
class __TwigTemplate_a141e8880711e72d935e94d24ac9e0bf3c7cecef96fe09bc8db62a7906aa9b7c extends \Twig\Template
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
        echo "<html lang=\"en\">
<head>  
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    
    <title>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 7), "title", [], "any", false, false, false, 7), "html", null, true);
        echo "</title>

    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/5.12.0/css/font-awesome.min.css\">
    <script
            src=\"https://code.jquery.com/jquery-3.4.1.min.js\"
            integrity=\"sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=\"
            crossorigin=\"anonymous\"></script>
        
    <link href=\"";
        // line 16
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/css/bootstrap.min.css", 1 => "assets/css/mdb.min.css", 2 => "assets/css/style.css", 3 => "assets/css/addons/rating.min.css", 4 => "assets/css/addons/star-rating-svg.css", 5 => "assets/lightGallery/css/lightgallery.css", 6 => "assets/lightGallery/css/lg-transitions.css"]);
        // line 24
        echo "\" rel=\"stylesheet\">
    
    ";
        // line 26
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 27
        echo "</head>
<body>";
    }

    public function getTemplateName()
    {
        return "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/head.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 27,  63 => 26,  59 => 24,  57 => 16,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<html lang=\"en\">
<head>  
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    
    <title>{{ this.page.title }}</title>

    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/5.12.0/css/font-awesome.min.css\">
    <script
            src=\"https://code.jquery.com/jquery-3.4.1.min.js\"
            integrity=\"sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=\"
            crossorigin=\"anonymous\"></script>
        
    <link href=\"{{ [
        'assets/css/bootstrap.min.css',
        'assets/css/mdb.min.css',
        'assets/css/style.css',
        'assets/css/addons/rating.min.css',
        'assets/css/addons/star-rating-svg.css',
        'assets/lightGallery/css/lightgallery.css',
        'assets/lightGallery/css/lg-transitions.css',
    ]|theme }}\" rel=\"stylesheet\">
    
    {% styles %}
</head>
<body>", "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/head.htm", "");
    }
}
