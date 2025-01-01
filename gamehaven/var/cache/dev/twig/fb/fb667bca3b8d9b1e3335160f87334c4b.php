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

/* @ApiPlatform/DataCollector/request.html.twig */
class __TwigTemplate_4eb877309abec66b2e975757ae4eca49 extends Template
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

        $this->blocks = [
            'toolbar' => [$this, 'block_toolbar'],
            'menu' => [$this, 'block_menu'],
            'panel' => [$this, 'block_panel'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@ApiPlatform/DataCollector/request.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@ApiPlatform/DataCollector/request.html.twig"));

        // line 77
        $macros["apiPlatform"] = $this->macros["apiPlatform"] = $this;
        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@ApiPlatform/DataCollector/request.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 79
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_toolbar(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "toolbar"));

        // line 80
        yield "    ";
        $context["icon"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 81
            yield "        ";
            $context["status_color"] = ((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "counters", [], "any", false, true, false, 81), "ignored_filters", [], "any", true, true, false, 81)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["collector"] ?? null), "counters", [], "any", false, true, false, 81), "ignored_filters", [], "any", false, false, false, 81), false)) : (false))) ? ("yellow") : ("default"));
            // line 82
            yield "        ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "@ApiPlatform/DataCollector/api-platform-icon.svg");
            yield "
    ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 84
        yield "
    ";
        // line 85
        $context["text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 86
            yield "        ";
            if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 86, $this->source); })()), "version", [], "any", false, false, false, 86)) {
                // line 87
                yield "            <div class=\"sf-toolbar-info-piece\">
                <b>Version</b>
                <span>";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 89, $this->source); })()), "version", [], "any", false, false, false, 89), "html", null, true);
                yield "</span>
            </div>
        ";
            }
            // line 92
            yield "        ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 92, $this->source); })()), "resources", [], "any", false, false, false, 92)) == 0)) {
                // line 93
                yield "            <div class=\"sf-toolbar-info-piece\">
                <b>Resource Class</b>
                <span>Not an API Platform resource</span>
            </div>
        ";
            }
            // line 98
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 98, $this->source); })()), "resources", [], "any", false, false, false, 98));
            foreach ($context['_seq'] as $context["_key"] => $context["resource"]) {
                // line 99
                yield "            <div class=\"sf-toolbar-info-piece\">
                <b>Resource Class</b>
                <span>";
                // line 101
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["resource"], "resourceClass", [], "any", false, false, false, 101), "html", null, true);
                yield "</span>
            </div>
            ";
                // line 103
                if (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["resource"], "counters", [], "any", false, true, false, 103), "ignored_filters", [], "any", true, true, false, 103)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["resource"], "counters", [], "any", false, true, false, 103), "ignored_filters", [], "any", false, false, false, 103), false)) : (false))) {
                    // line 104
                    yield "                <div class=\"sf-toolbar-info-piece\">
                    <b>Ignored Filters</b>
                    <span class=\"sf-toolbar-status sf-toolbar-status-yellow\">";
                    // line 106
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 106, $this->source); })()), "counters", [], "any", false, false, false, 106), "ignored_filters", [], "any", false, false, false, 106), "html", null, true);
                    yield "</span>
                </div>
            ";
                }
                // line 109
                yield "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['resource'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 110
            yield "    ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 111
        yield "
    ";
        // line 112
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@WebProfiler/Profiler/toolbar_item.html.twig", ["link" => true, "status" => (isset($context["status_color"]) || array_key_exists("status_color", $context) ? $context["status_color"] : (function () { throw new RuntimeError('Variable "status_color" does not exist.', 112, $this->source); })())]);
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 115
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_menu(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "menu"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "menu"));

        // line 116
        yield "    ";
        // line 117
        yield "    <span class=\"label";
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 117, $this->source); })()), "resources", [], "any", false, false, false, 117)) ? ("") : (" disabled"));
        yield "\">
        <span class=\"icon\">
            ";
        // line 119
        yield Twig\Extension\CoreExtension::include($this->env, $context, "@ApiPlatform/DataCollector/api-platform.svg");
        yield "
        </span>
        <strong>API Platform</strong>
    </span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 125
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_panel(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "panel"));

        // line 126
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 126, $this->source); })()), "resources", [], "any", false, false, false, 126)) == 0)) {
            // line 127
            yield "        <div class=\"metrics\">
            <div class=\"metric\">
                <span class=\"value\">Not an API Platform resource</span>
                <span class=\"label\">Resource Class</span>
            </div>
        </div>
    ";
        }
        // line 134
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["collector"]) || array_key_exists("collector", $context) ? $context["collector"] : (function () { throw new RuntimeError('Variable "collector" does not exist.', 134, $this->source); })()), "resources", [], "any", false, false, false, 134));
        foreach ($context['_seq'] as $context["_key"] => $context["dataCollected"]) {
            // line 135
            yield "        <div class=\"metrics\">
            <div class=\"metric\">
                <span class=\"value\">";
            // line 137
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "resourceClass", [], "any", true, true, false, 137)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "resourceClass", [], "any", false, false, false, 137), "Not an API Platform resource")) : ("Not an API Platform resource")), "html", null, true);
            yield "</span>
                <span class=\"label\">Resource Class</span>
            </div>
        </div>
        ";
            // line 141
            if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "resourceMetadataCollection", [], "any", false, false, false, 141))) {
                // line 142
                yield "            <h3>Resources</h3>
            <div class=\"tab-content metadata-tab-content\">
                <div class=\"sf-tabs\">
                    ";
                // line 145
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "resourceMetadataCollection", [], "any", false, false, false, 145));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["resourceMetadata"]) {
                    // line 146
                    yield "                        <div class=\"tab\">
                            <h3 class=\"tab-title\">
                                ";
                    // line 148
                    yield ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["resourceMetadata"], "resource", [], "any", false, false, false, 148), "uriTemplate", [], "any", false, false, false, 148)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["resourceMetadata"], "resource", [], "any", false, false, false, 148), "uriTemplate", [], "any", false, false, false, 148), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["resourceMetadata"], "resource", [], "any", false, false, false, 148), "shortName", [], "any", false, false, false, 148), "html", null, true)));
                    yield "
                            </h3>
                            <div class=\"tab-content\">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope=\"col\" class=\"key\">Resource</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>";
                    // line 159
                    yield $this->extensions['Symfony\Bundle\WebProfilerBundle\Twig\WebProfilerExtension']->dumpData($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["resourceMetadata"], "resource", [], "any", false, false, false, 159), 1);
                    yield "</td>
                                        </tr>
                                    </tbody>
                                </table>
                                ";
                    // line 163
                    yield $macros["apiPlatform"]->getTemplateForMacro("macro_operationTable", $context, 163, $this->getSourceContext())->macro_operationTable(...[CoreExtension::getAttribute($this->env, $this->source, $context["resourceMetadata"], "operations", [], "any", false, false, false, 163), "", ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "requestAttributes", [], "any", false, true, false, 163), "operation_name", [], "any", true, true, false, 163)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "requestAttributes", [], "any", false, true, false, 163), "operation_name", [], "any", false, false, false, 163), "")) : (""))]);
                    yield "
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope=\"col\" class=\"key\">Filters</th>
                                            <th scope=\"col\"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";
                    // line 172
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "filters", [], "any", false, false, false, 172) && CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 172), Twig\Extension\CoreExtension::keys(CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "filters", [], "any", false, false, false, 172))))) {
                        // line 173
                        yield "                                            ";
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["dataCollected"], "filters", [], "any", false, false, false, 173), CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 173), [], "array", false, false, false, 173));
                        $context['loop'] = [
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        ];
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["id"] => $context["filter"]) {
                            // line 174
                            yield "                                                ";
                            $context["ignored_filter"] = ($context["filter"] === null);
                            // line 175
                            yield "                                                <tr";
                            if ((isset($context["ignored_filter"]) || array_key_exists("ignored_filter", $context) ? $context["ignored_filter"] : (function () { throw new RuntimeError('Variable "ignored_filter" does not exist.', 175, $this->source); })())) {
                                yield " class=\"status-warning\"";
                            }
                            yield ">
                                                    <td>
                                                        ";
                            // line 177
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["id"], "html", null, true);
                            yield "
                                                        ";
                            // line 178
                            if ((isset($context["ignored_filter"]) || array_key_exists("ignored_filter", $context) ? $context["ignored_filter"] : (function () { throw new RuntimeError('Variable "ignored_filter" does not exist.', 178, $this->source); })())) {
                                // line 179
                                yield "                                                            <span class=\"newline text-muted\">ignored filter</span>
                                                        ";
                            } else {
                                // line 181
                                yield "                                                            ";
                                yield $this->extensions['Symfony\Bridge\Twig\Extension\DumpExtension']->dump($this->env, $context, $context["filter"]);
                                yield "
                                                        ";
                            }
                            // line 183
                            yield "                                                    </td>
                                                </tr>
                                            ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['id'], $context['filter'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 186
                        yield "                                        ";
                    } else {
                        // line 187
                        yield "                                            <tr>
                                                <td class=\"text-muted\" colspan=\"2\">
                                                    No available filter declared for this resource.
                                                </td>
                                            </tr>
                                        ";
                    }
                    // line 193
                    yield "                                    </tbody>
                                </table>
                            </div>
                        </div>
                    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['resourceMetadata'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 198
                yield "                </div>
            </div>
        ";
            }
            // line 201
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['dataCollected'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 3
    public function macro_operationLine($key = null, $operation = null, $actualOperationName = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "key" => $key,
            "operation" => $operation,
            "actualOperationName" => $actualOperationName,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "operationLine"));

            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "operationLine"));

            // line 4
            yield "    <tr>
        <th scope=\"row\"";
            // line 5
            if (((isset($context["key"]) || array_key_exists("key", $context) ? $context["key"] : (function () { throw new RuntimeError('Variable "key" does not exist.', 5, $this->source); })()) == (isset($context["actualOperationName"]) || array_key_exists("actualOperationName", $context) ? $context["actualOperationName"] : (function () { throw new RuntimeError('Variable "actualOperationName" does not exist.', 5, $this->source); })()))) {
                yield " class=\"status-success\"";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["key"]) || array_key_exists("key", $context) ? $context["key"] : (function () { throw new RuntimeError('Variable "key" does not exist.', 5, $this->source); })()), "html", null, true);
            yield "</th>
        <td";
            // line 6
            if (((isset($context["key"]) || array_key_exists("key", $context) ? $context["key"] : (function () { throw new RuntimeError('Variable "key" does not exist.', 6, $this->source); })()) == (isset($context["actualOperationName"]) || array_key_exists("actualOperationName", $context) ? $context["actualOperationName"] : (function () { throw new RuntimeError('Variable "actualOperationName" does not exist.', 6, $this->source); })()))) {
                yield " class=\"status-success\"";
            }
            yield ">";
            yield $this->extensions['Symfony\Bundle\WebProfilerBundle\Twig\WebProfilerExtension']->dumpData($this->env, (isset($context["operation"]) || array_key_exists("operation", $context) ? $context["operation"] : (function () { throw new RuntimeError('Variable "operation" does not exist.', 6, $this->source); })()), 1);
            yield "</td>
    </tr>
";
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

            
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 10
    public function macro_operationTable($object = null, $name = null, $actualOperationName = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "object" => $object,
            "name" => $name,
            "actualOperationName" => $actualOperationName,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "operationTable"));

            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "operationTable"));

            // line 11
            yield "    ";
            $macros["apiPlatform"] = $this;
            // line 12
            yield "    <table>
        <thead>
            <tr>
                <th scope=\"col\" class=\"key\">";
            // line 15
            if (array_key_exists("name", $context)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 15, $this->source); })())), "html", null, true);
            }
            yield "Operations</th>
                <th scope=\"col\">Attributes</th>
            </tr>
        </thead>

        <tbody>
        ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["object"]) || array_key_exists("object", $context) ? $context["object"] : (function () { throw new RuntimeError('Variable "object" does not exist.', 21, $this->source); })()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["key"] => $context["itemOperation"]) {
                // line 22
                yield "            ";
                yield $macros["apiPlatform"]->getTemplateForMacro("macro_operationLine", $context, 22, $this->getSourceContext())->macro_operationLine(...[$context["key"], $context["itemOperation"], (isset($context["actualOperationName"]) || array_key_exists("actualOperationName", $context) ? $context["actualOperationName"] : (function () { throw new RuntimeError('Variable "actualOperationName" does not exist.', 22, $this->source); })())]);
                yield "
        ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 24
                yield "            <tr>
                <td colspan=\"2\" class=\"text-muted\">
                    No available ";
                // line 26
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 26, $this->source); })())), "html", null, true);
                yield " operation for this resource.
                </td>
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['key'], $context['itemOperation'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 30
            yield "        </tbody>
    </table>
";
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

            
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 34
    public function macro_providerTable($object = null, $name = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "object" => $object,
            "name" => $name,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "providerTable"));

            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "providerTable"));

            // line 35
            yield "    ";
            if (Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["object"]) || array_key_exists("object", $context) ? $context["object"] : (function () { throw new RuntimeError('Variable "object" does not exist.', 35, $this->source); })()), "responses", [], "any", false, false, false, 35))) {
                // line 36
                yield "        <div class=\"empty\">
            <p>No calls to ";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 37, $this->source); })()), "html", null, true);
                yield " have been recorded.</p>
        </div>
    ";
            } else {
                // line 40
                yield "        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Used</th>
                <th>";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new RuntimeError('Variable "name" does not exist.', 45, $this->source); })())), "html", null, true);
                yield "</th>
            </tr>
            </thead>
            <tbody>
            ";
                // line 49
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["object"]) || array_key_exists("object", $context) ? $context["object"] : (function () { throw new RuntimeError('Variable "object" does not exist.', 49, $this->source); })()), "responses", [], "any", false, false, false, 49));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["class"] => $context["used"]) {
                    // line 50
                    yield "                <tr>
                    <td class=\"font-normal text-small text-muted nowrap\">";
                    // line 51
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 51), "html", null, true);
                    yield "</td>
                    <td class=\"font-normal\">
                        ";
                    // line 53
                    if (($context["used"] === true)) {
                        // line 54
                        yield "                            <span class=\"label status-success same-width\">TRUE</span>
                        ";
                    } elseif ((                    // line 55
$context["used"] === false)) {
                        // line 56
                        yield "                            <span class=\"label status-error same-width\">FALSE</span>
                        ";
                    } else {
                        // line 58
                        yield "                            <span class=\"label status-info same-width\">NOT USED</span>
                        ";
                    }
                    // line 60
                    yield "                    </td>
                    <td class=\"font-normal\">";
                    // line 61
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["class"], "html", null, true);
                    yield "</td>
                </tr>
            ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['class'], $context['used'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 64
                yield "            </tbody>
            ";
                // line 65
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["object"] ?? null), "context", [], "any", true, true, false, 65)) {
                    // line 66
                    yield "                <tfoot>
                    <tr>
                        <td class=\"font-normal\" colspan=\"2\"></td>
                        <td class=\"font-normal\">Context";
                    // line 69
                    yield $this->extensions['Symfony\Bundle\WebProfilerBundle\Twig\WebProfilerExtension']->dumpData($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["object"]) || array_key_exists("object", $context) ? $context["object"] : (function () { throw new RuntimeError('Variable "object" does not exist.', 69, $this->source); })()), "context", [], "any", false, false, false, 69), 2);
                    yield "</td>
                    </tr>
                </tfoot>
            ";
                }
                // line 73
                yield "        </table>
    ";
            }
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

            
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@ApiPlatform/DataCollector/request.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  677 => 73,  670 => 69,  665 => 66,  663 => 65,  660 => 64,  643 => 61,  640 => 60,  636 => 58,  632 => 56,  630 => 55,  627 => 54,  625 => 53,  620 => 51,  617 => 50,  600 => 49,  593 => 45,  586 => 40,  580 => 37,  577 => 36,  574 => 35,  555 => 34,  541 => 30,  531 => 26,  527 => 24,  519 => 22,  514 => 21,  503 => 15,  498 => 12,  495 => 11,  475 => 10,  456 => 6,  448 => 5,  445 => 4,  425 => 3,  410 => 201,  405 => 198,  387 => 193,  379 => 187,  376 => 186,  360 => 183,  354 => 181,  350 => 179,  348 => 178,  344 => 177,  336 => 175,  333 => 174,  315 => 173,  313 => 172,  301 => 163,  294 => 159,  280 => 148,  276 => 146,  259 => 145,  254 => 142,  252 => 141,  245 => 137,  241 => 135,  236 => 134,  227 => 127,  224 => 126,  211 => 125,  195 => 119,  189 => 117,  187 => 116,  174 => 115,  161 => 112,  158 => 111,  154 => 110,  148 => 109,  142 => 106,  138 => 104,  136 => 103,  131 => 101,  127 => 99,  122 => 98,  115 => 93,  112 => 92,  106 => 89,  102 => 87,  99 => 86,  97 => 85,  94 => 84,  87 => 82,  84 => 81,  81 => 80,  68 => 79,  57 => 1,  55 => 77,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% macro operationLine(key, operation, actualOperationName) %}
    <tr>
        <th scope=\"row\"{% if key == actualOperationName %} class=\"status-success\"{% endif %}>{{ key }}</th>
        <td{% if key == actualOperationName %} class=\"status-success\"{% endif %}>{{- profiler_dump(operation, 1) -}}</td>
    </tr>
{% endmacro %}

{% macro operationTable(object, name, actualOperationName) %}
    {% import _self as apiPlatform %}
    <table>
        <thead>
            <tr>
                <th scope=\"col\" class=\"key\">{% if name is defined %}{{ name|capitalize }}{% endif %}Operations</th>
                <th scope=\"col\">Attributes</th>
            </tr>
        </thead>

        <tbody>
        {% for key, itemOperation in object %}
            {{ apiPlatform.operationLine(key, itemOperation, actualOperationName) }}
        {% else %}
            <tr>
                <td colspan=\"2\" class=\"text-muted\">
                    No available {{ name|lower }} operation for this resource.
                </td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endmacro %}

{% macro providerTable(object, name) %}
    {% if object.responses is empty %}
        <div class=\"empty\">
            <p>No calls to {{ name }} have been recorded.</p>
        </div>
    {% else %}
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Used</th>
                <th>{{ name|capitalize }}</th>
            </tr>
            </thead>
            <tbody>
            {% for class, used in object.responses %}
                <tr>
                    <td class=\"font-normal text-small text-muted nowrap\">{{ loop.index }}</td>
                    <td class=\"font-normal\">
                        {% if used is same as(true) %}
                            <span class=\"label status-success same-width\">TRUE</span>
                        {% elseif used is same as(false) %}
                            <span class=\"label status-error same-width\">FALSE</span>
                        {% else %}
                            <span class=\"label status-info same-width\">NOT USED</span>
                        {% endif %}
                    </td>
                    <td class=\"font-normal\">{{ class }}</td>
                </tr>
            {% endfor %}
            </tbody>
            {% if object.context is defined %}
                <tfoot>
                    <tr>
                        <td class=\"font-normal\" colspan=\"2\"></td>
                        <td class=\"font-normal\">Context{{ profiler_dump(object.context, 2) }}</td>
                    </tr>
                </tfoot>
            {% endif %}
        </table>
    {% endif %}
{% endmacro %}

{% import _self as apiPlatform %}

{% block toolbar %}
    {% set icon %}
        {% set status_color = collector.counters.ignored_filters|default(false) ? 'yellow' : 'default' %}
        {{ include('@ApiPlatform/DataCollector/api-platform-icon.svg') }}
    {% endset %}

    {% set text %}
        {% if collector.version %}
            <div class=\"sf-toolbar-info-piece\">
                <b>Version</b>
                <span>{{ collector.version }}</span>
            </div>
        {% endif %}
        {% if collector.resources|length == 0 %}
            <div class=\"sf-toolbar-info-piece\">
                <b>Resource Class</b>
                <span>Not an API Platform resource</span>
            </div>
        {% endif %}
        {% for resource in collector.resources %}
            <div class=\"sf-toolbar-info-piece\">
                <b>Resource Class</b>
                <span>{{ resource.resourceClass }}</span>
            </div>
            {% if resource.counters.ignored_filters|default(false) %}
                <div class=\"sf-toolbar-info-piece\">
                    <b>Ignored Filters</b>
                    <span class=\"sf-toolbar-status sf-toolbar-status-yellow\">{{ collector.counters.ignored_filters }}</span>
                </div>
            {% endif %}
        {% endfor %}
    {% endset %}

    {{ include('@WebProfiler/Profiler/toolbar_item.html.twig', { 'link': true, status: status_color }) }}
{% endblock %}

{% block menu %}
    {# This left-hand menu appears when using the full-screen profiler. #}
    <span class=\"label{{ collector.resources ? '' : ' disabled' }}\">
        <span class=\"icon\">
            {{ include('@ApiPlatform/DataCollector/api-platform.svg') }}
        </span>
        <strong>API Platform</strong>
    </span>
{% endblock %}

{% block panel %}
    {% if collector.resources|length == 0 %}
        <div class=\"metrics\">
            <div class=\"metric\">
                <span class=\"value\">Not an API Platform resource</span>
                <span class=\"label\">Resource Class</span>
            </div>
        </div>
    {% endif %}
    {% for dataCollected in collector.resources %}
        <div class=\"metrics\">
            <div class=\"metric\">
                <span class=\"value\">{{ dataCollected.resourceClass|default('Not an API Platform resource') }}</span>
                <span class=\"label\">Resource Class</span>
            </div>
        </div>
        {% if dataCollected.resourceMetadataCollection is not empty %}
            <h3>Resources</h3>
            <div class=\"tab-content metadata-tab-content\">
                <div class=\"sf-tabs\">
                    {% for resourceMetadata in dataCollected.resourceMetadataCollection %}
                        <div class=\"tab\">
                            <h3 class=\"tab-title\">
                                {{ resourceMetadata.resource.uriTemplate ?: resourceMetadata.resource.shortName }}
                            </h3>
                            <div class=\"tab-content\">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope=\"col\" class=\"key\">Resource</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{- profiler_dump(resourceMetadata.resource, 1) -}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{ apiPlatform.operationTable(resourceMetadata.operations, '', dataCollected.requestAttributes.operation_name|default('')) }}
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope=\"col\" class=\"key\">Filters</th>
                                            <th scope=\"col\"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {% if dataCollected.filters and loop.index0 in dataCollected.filters|keys %}
                                            {% for id, filter in dataCollected.filters[loop.index0] %}
                                                {% set ignored_filter = filter is same as(null) %}
                                                <tr{% if ignored_filter %} class=\"status-warning\"{% endif %}>
                                                    <td>
                                                        {{ id }}
                                                        {% if ignored_filter %}
                                                            <span class=\"newline text-muted\">ignored filter</span>
                                                        {% else %}
                                                            {{ dump(filter) }}
                                                        {% endif %}
                                                    </td>
                                                </tr>
                                            {% endfor %}
                                        {% else %}
                                            <tr>
                                                <td class=\"text-muted\" colspan=\"2\">
                                                    No available filter declared for this resource.
                                                </td>
                                            </tr>
                                        {% endif %}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    {% endfor %}
                </div>
            </div>
        {% endif %}
    {% endfor %}
{% endblock %}

", "@ApiPlatform/DataCollector/request.html.twig", "/home/medgm/vsc/gamehaven2/vendor/api-platform/symfony/Bundle/Resources/views/DataCollector/request.html.twig");
    }
}
