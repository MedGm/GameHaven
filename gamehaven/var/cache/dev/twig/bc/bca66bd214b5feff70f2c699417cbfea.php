<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* @ApiPlatform/GraphQlPlayground/index.html.twig */
class __TwigTemplate_ec162818a4f2d8d4ea9d73bf0f2b6e80 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head_metas' => [$this, 'block_head_metas'],
            'title' => [$this, 'block_title'],
            'head_stylesheets' => [$this, 'block_head_stylesheets'],
            'head_javascript' => [$this, 'block_head_javascript'],
            'body_stylesheets' => [$this, 'block_body_stylesheets'],
            'logo' => [$this, 'block_logo'],
            'loading' => [$this, 'block_loading'],
            'body_javascript' => [$this, 'block_body_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@ApiPlatform/GraphQlPlayground/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@ApiPlatform/GraphQlPlayground/index.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    ";
        // line 4
        yield from $this->unwrap()->yieldBlock('head_metas', $context, $blocks);
        // line 8
        yield "
    ";
        // line 9
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 12
        yield "
    ";
        // line 13
        yield from $this->unwrap()->yieldBlock('head_stylesheets', $context, $blocks);
        // line 16
        yield "
    ";
        // line 17
        yield from $this->unwrap()->yieldBlock('head_javascript', $context, $blocks);
        // line 22
        yield "</head>

<body>
";
        // line 25
        yield from $this->unwrap()->yieldBlock('body_stylesheets', $context, $blocks);
        // line 28
        yield "
<div id=\"loading-wrapper\">
    ";
        // line 30
        yield from $this->unwrap()->yieldBlock('logo', $context, $blocks);
        // line 60
        yield "
    ";
        // line 61
        yield from $this->unwrap()->yieldBlock('loading', $context, $blocks);
        // line 66
        yield "</div>

<div id=\"graphql-playground\" />

";
        // line 70
        yield from $this->unwrap()->yieldBlock('body_javascript', $context, $blocks);
        // line 73
        yield "</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_metas(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_metas"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_metas"));

        // line 5
        yield "        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui\">
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 10
        yield "        <title>";
        if ((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 10, $this->source); })())) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 10, $this->source); })()), "html", null, true);
            yield " - ";
        }
        yield "API Platform</title>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_stylesheets"));

        // line 14
        yield "        <link rel=\"stylesheet\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("bundles/apiplatform/graphql-playground/index.css", (isset($context["assetPackage"]) || array_key_exists("assetPackage", $context) ? $context["assetPackage"] : (function () { throw new RuntimeError('Variable "assetPackage" does not exist.', 14, $this->source); })())), "html", null, true);
        yield "\">
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head_javascript(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_javascript"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head_javascript"));

        // line 18
        yield "        <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("bundles/apiplatform/graphql-playground/middleware.js", (isset($context["assetPackage"]) || array_key_exists("assetPackage", $context) ? $context["assetPackage"] : (function () { throw new RuntimeError('Variable "assetPackage" does not exist.', 18, $this->source); })())), "html", null, true);
        yield "\"></script>
        ";
        // line 20
        yield "        <script id=\"graphql-playground-data\" type=\"application/json\">";
        yield json_encode((isset($context["graphql_playground_data"]) || array_key_exists("graphql_playground_data", $context) ? $context["graphql_playground_data"] : (function () { throw new RuntimeError('Variable "graphql_playground_data" does not exist.', 20, $this->source); })()), 65);
        yield "</script>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 25
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_stylesheets"));

        // line 26
        yield "    <link rel=\"stylesheet\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("bundles/apiplatform/graphql-playground-style.css", (isset($context["assetPackage"]) || array_key_exists("assetPackage", $context) ? $context["assetPackage"] : (function () { throw new RuntimeError('Variable "assetPackage" does not exist.', 26, $this->source); })())), "html", null, true);
        yield "\">
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 30
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_logo(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "logo"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "logo"));

        // line 31
        yield "        <svg class=\"logo\" viewBox=\"0 0 128 128\">
        <title>GraphQL Playground Logo</title>
        <defs>
            <linearGradient id=\"linearGradient-1\" x1=\"4.86%\" x2=\"96.21%\" y1=\"0%\" y2=\"99.66%\">
                <stop stop-color=\"#E00082\" stop-opacity=\".8\" offset=\"0%\"></stop>
                <stop stop-color=\"#E00082\" offset=\"100%\"></stop>
            </linearGradient>
        </defs>
        <g>
            <rect id=\"Gradient\" width=\"127.96\" height=\"127.96\" y=\"1\" fill=\"url(#linearGradient-1)\" rx=\"4\"></rect>
            <path id=\"Border\" fill=\"#E00082\" fill-rule=\"nonzero\" d=\"M4.7 2.84c-1.58 0-2.86 1.28-2.86 2.85v116.57c0 1.57 1.28 2.84 2.85 2.84h116.57c1.57 0 2.84-1.26 2.84-2.83V5.67c0-1.55-1.26-2.83-2.83-2.83H4.67zM4.7 0h116.58c3.14 0 5.68 2.55 5.68 5.7v116.58c0 3.14-2.54 5.68-5.68 5.68H4.68c-3.13 0-5.68-2.54-5.68-5.68V5.68C-1 2.56 1.55 0 4.7 0z\"></path>
            <path class=\"bglIGM transform-translate-100x100\" x=\"64\" y=\"28\" fill=\"#fff\" d=\"M64 36c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8\"></path>
            <path class=\"ksxRII transform-translate-100x100\" x=\"95.98500061035156\" y=\"46.510000228881836\" fill=\"#fff\" d=\"M89.04 50.52c-2.2-3.84-.9-8.73 2.94-10.96 3.83-2.2 8.72-.9 10.95 2.94 2.2 3.84.9 8.73-2.94 10.96-3.85 2.2-8.76.9-10.97-2.94\"></path>
            <path class=\"cWrBmb transform-translate-100x100\" x=\"95.97162628173828\" y=\"83.4900016784668\" fill=\"#fff\" d=\"M102.9 87.5c-2.2 3.84-7.1 5.15-10.94 2.94-3.84-2.2-5.14-7.12-2.94-10.96 2.2-3.84 7.12-5.15 10.95-2.94 3.86 2.23 5.16 7.12 2.94 10.96\"></path>
            <path class=\"Wnusb transform-translate-100x100\" x=\"64\" y=\"101.97999572753906\" fill=\"#fff\" d=\"M64 110c-4.43 0-8-3.6-8-8.02 0-4.44 3.57-8.02 8-8.02s8 3.58 8 8.02c0 4.4-3.57 8.02-8 8.02\" ></path>
            <path class=\"bfPqf transform-translate-100x100\" x=\"32.03982162475586\" y=\"83.4900016784668\" fill=\"#fff\" d=\"M25.1 87.5c-2.2-3.84-.9-8.73 2.93-10.96 3.83-2.2 8.72-.9 10.95 2.94 2.2 3.84.9 8.73-2.94 10.96-3.85 2.2-8.74.9-10.95-2.94\"></path>
            <path class=\"edRCTN transform-translate-100x100\" x=\"32.033552169799805\" y=\"46.510000228881836\" fill=\"#fff\" d=\"M38.96 50.52c-2.2 3.84-7.12 5.15-10.95 2.94-3.82-2.2-5.12-7.12-2.92-10.96 2.2-3.84 7.12-5.15 10.95-2.94 3.83 2.23 5.14 7.12 2.94 10.96\"></path>
            <path class=\"iEGVWn\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M63.55 27.5l32.9 19-32.9-19z\"></path>
            <path class=\"bsocdx\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M96 46v38-38z\"></path>
            <path class=\"jAZXmP\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M96.45 84.5l-32.9 19 32.9-19z\"></path>
            <path class=\"hSeArx\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M64.45 103.5l-32.9-19 32.9 19z\"></path>
            <path class=\"bVgqGk\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M32 84V46v38z\"></path>
            <path class=\"hEFqBt\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M31.55 46.5l32.9-19-32.9 19z\"></path>
            <path class=\"dzEKCM\" id=\"Triangle-Bottom\" stroke=\"#fff\" stroke-width=\"4\" d=\"M30 84h70\" stroke-linecap=\"round\"></path>
            <path class=\"DYnPx\" id=\"Triangle-Left\" stroke=\"#fff\" stroke-width=\"4\" d=\"M65 26L30 87\" stroke-linecap=\"round\"></path>
            <path class=\"hjPEAQ\" id=\"Triangle-Right\" stroke=\"#fff\" stroke-width=\"4\" d=\"M98 87L63 26\" stroke-linecap=\"round\"></path>
        </g>
    </svg>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 61
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_loading(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "loading"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "loading"));

        // line 62
        yield "    <div class=\"text\">Loading
        <span class=\"dGfHfc\">API Platform GraphQL Playground</span>
    </div>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 70
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_javascript(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_javascript"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_javascript"));

        // line 71
        yield "    <script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("bundles/apiplatform/init-graphql-playground.js", (isset($context["assetPackage"]) || array_key_exists("assetPackage", $context) ? $context["assetPackage"] : (function () { throw new RuntimeError('Variable "assetPackage" does not exist.', 71, $this->source); })())), "html", null, true);
        yield "\"></script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@ApiPlatform/GraphQlPlayground/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  351 => 71,  338 => 70,  324 => 62,  311 => 61,  272 => 31,  259 => 30,  245 => 26,  232 => 25,  218 => 20,  213 => 18,  200 => 17,  186 => 14,  173 => 13,  156 => 10,  143 => 9,  130 => 5,  117 => 4,  104 => 73,  102 => 70,  96 => 66,  94 => 61,  91 => 60,  89 => 30,  85 => 28,  83 => 25,  78 => 22,  76 => 17,  73 => 16,  71 => 13,  68 => 12,  66 => 9,  63 => 8,  61 => 4,  56 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    {% block head_metas %}
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui\">
    {% endblock head_metas %}

    {% block title %}
        <title>{% if title %}{{ title }} - {% endif %}API Platform</title>
    {% endblock %}

    {% block head_stylesheets %}
        <link rel=\"stylesheet\" href=\"{{ asset('bundles/apiplatform/graphql-playground/index.css', assetPackage) }}\">
    {% endblock %}

    {% block head_javascript %}
        <script src=\"{{ asset('bundles/apiplatform/graphql-playground/middleware.js', assetPackage) }}\"></script>
        {# json_encode(65) is for JSON_UNESCAPED_SLASHES|JSON_HEX_TAG to avoid JS XSS #}
        <script id=\"graphql-playground-data\" type=\"application/json\">{{ graphql_playground_data|json_encode(65)|raw }}</script>
    {% endblock head_javascript %}
</head>

<body>
{% block body_stylesheets %}
    <link rel=\"stylesheet\" href=\"{{ asset('bundles/apiplatform/graphql-playground-style.css', assetPackage) }}\">
{% endblock %}

<div id=\"loading-wrapper\">
    {% block logo %}
        <svg class=\"logo\" viewBox=\"0 0 128 128\">
        <title>GraphQL Playground Logo</title>
        <defs>
            <linearGradient id=\"linearGradient-1\" x1=\"4.86%\" x2=\"96.21%\" y1=\"0%\" y2=\"99.66%\">
                <stop stop-color=\"#E00082\" stop-opacity=\".8\" offset=\"0%\"></stop>
                <stop stop-color=\"#E00082\" offset=\"100%\"></stop>
            </linearGradient>
        </defs>
        <g>
            <rect id=\"Gradient\" width=\"127.96\" height=\"127.96\" y=\"1\" fill=\"url(#linearGradient-1)\" rx=\"4\"></rect>
            <path id=\"Border\" fill=\"#E00082\" fill-rule=\"nonzero\" d=\"M4.7 2.84c-1.58 0-2.86 1.28-2.86 2.85v116.57c0 1.57 1.28 2.84 2.85 2.84h116.57c1.57 0 2.84-1.26 2.84-2.83V5.67c0-1.55-1.26-2.83-2.83-2.83H4.67zM4.7 0h116.58c3.14 0 5.68 2.55 5.68 5.7v116.58c0 3.14-2.54 5.68-5.68 5.68H4.68c-3.13 0-5.68-2.54-5.68-5.68V5.68C-1 2.56 1.55 0 4.7 0z\"></path>
            <path class=\"bglIGM transform-translate-100x100\" x=\"64\" y=\"28\" fill=\"#fff\" d=\"M64 36c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8\"></path>
            <path class=\"ksxRII transform-translate-100x100\" x=\"95.98500061035156\" y=\"46.510000228881836\" fill=\"#fff\" d=\"M89.04 50.52c-2.2-3.84-.9-8.73 2.94-10.96 3.83-2.2 8.72-.9 10.95 2.94 2.2 3.84.9 8.73-2.94 10.96-3.85 2.2-8.76.9-10.97-2.94\"></path>
            <path class=\"cWrBmb transform-translate-100x100\" x=\"95.97162628173828\" y=\"83.4900016784668\" fill=\"#fff\" d=\"M102.9 87.5c-2.2 3.84-7.1 5.15-10.94 2.94-3.84-2.2-5.14-7.12-2.94-10.96 2.2-3.84 7.12-5.15 10.95-2.94 3.86 2.23 5.16 7.12 2.94 10.96\"></path>
            <path class=\"Wnusb transform-translate-100x100\" x=\"64\" y=\"101.97999572753906\" fill=\"#fff\" d=\"M64 110c-4.43 0-8-3.6-8-8.02 0-4.44 3.57-8.02 8-8.02s8 3.58 8 8.02c0 4.4-3.57 8.02-8 8.02\" ></path>
            <path class=\"bfPqf transform-translate-100x100\" x=\"32.03982162475586\" y=\"83.4900016784668\" fill=\"#fff\" d=\"M25.1 87.5c-2.2-3.84-.9-8.73 2.93-10.96 3.83-2.2 8.72-.9 10.95 2.94 2.2 3.84.9 8.73-2.94 10.96-3.85 2.2-8.74.9-10.95-2.94\"></path>
            <path class=\"edRCTN transform-translate-100x100\" x=\"32.033552169799805\" y=\"46.510000228881836\" fill=\"#fff\" d=\"M38.96 50.52c-2.2 3.84-7.12 5.15-10.95 2.94-3.82-2.2-5.12-7.12-2.92-10.96 2.2-3.84 7.12-5.15 10.95-2.94 3.83 2.23 5.14 7.12 2.94 10.96\"></path>
            <path class=\"iEGVWn\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M63.55 27.5l32.9 19-32.9-19z\"></path>
            <path class=\"bsocdx\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M96 46v38-38z\"></path>
            <path class=\"jAZXmP\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M96.45 84.5l-32.9 19 32.9-19z\"></path>
            <path class=\"hSeArx\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M64.45 103.5l-32.9-19 32.9 19z\"></path>
            <path class=\"bVgqGk\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M32 84V46v38z\"></path>
            <path class=\"hEFqBt\" stroke=\"#fff\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M31.55 46.5l32.9-19-32.9 19z\"></path>
            <path class=\"dzEKCM\" id=\"Triangle-Bottom\" stroke=\"#fff\" stroke-width=\"4\" d=\"M30 84h70\" stroke-linecap=\"round\"></path>
            <path class=\"DYnPx\" id=\"Triangle-Left\" stroke=\"#fff\" stroke-width=\"4\" d=\"M65 26L30 87\" stroke-linecap=\"round\"></path>
            <path class=\"hjPEAQ\" id=\"Triangle-Right\" stroke=\"#fff\" stroke-width=\"4\" d=\"M98 87L63 26\" stroke-linecap=\"round\"></path>
        </g>
    </svg>
    {% endblock %}

    {% block loading %}
    <div class=\"text\">Loading
        <span class=\"dGfHfc\">API Platform GraphQL Playground</span>
    </div>
    {% endblock %}
</div>

<div id=\"graphql-playground\" />

{% block body_javascript %}
    <script src=\"{{ asset('bundles/apiplatform/init-graphql-playground.js', assetPackage) }}\"></script>
{% endblock body_javascript %}
</body>
</html>
", "@ApiPlatform/GraphQlPlayground/index.html.twig", "/home/medgm/vsc/gamehaven2/vendor/api-platform/symfony/Bundle/Resources/views/GraphQlPlayground/index.html.twig");
    }
}
