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

/* /var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/footer.htm */
class __TwigTemplate_49b84c0da44c13602f8445e37bf402bdf5d7426277fe6ca001eb75b5c1e1e3ca extends \Twig\Template
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
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("footer/4-column"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 2
        echo "
<script src=\"";
        // line 3
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/js/popper.js", 1 => "assets/js/bootstrap.min.js", 2 => "assets/js/mdb.min.js", 3 => "assets/js/addons/rating.min.js", 4 => "assets/js/addons/jquery.star-rating-svg.js", 5 => "assets/lightGallery/js/lightgallery-all.js", 6 => "assets/lightGallery/modules/lg-thumbnail.js"]);
        // line 11
        echo "\"></script>

<script>
    new WOW().init();
    \$(\"#lightgallery\").lightGallery({
        thumbnail:true
    });
</script>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 11,  44 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% partial 'footer/4-column' %}

<script src=\"{{ [
        'assets/js/popper.js',
        'assets/js/bootstrap.min.js',
        'assets/js/mdb.min.js',
        'assets/js/addons/rating.min.js',
        'assets/js/addons/jquery.star-rating-svg.js',
        'assets/lightGallery/js/lightgallery-all.js',
        'assets/lightGallery/modules/lg-thumbnail.js',
    ]|theme }}\"></script>

<script>
    new WOW().init();
    \$(\"#lightgallery\").lightGallery({
        thumbnail:true
    });
</script>

</body>
</html>", "/var/www/html/install-master/themes/zanor-zanor-mdb-loaded/partials/site/footer.htm", "");
    }
}
