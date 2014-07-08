{% extends "layouts/main.volt" %}

{% block content %}


    {{ link_to("products/search", "Search") }}
{{  t("sistema") }}

{{ image("img/hello.gif", {"alt": "alternative text"}) }}

{{ image('img/avatar3.png', "class":"img-circle", "alt": "User Image") }}

<h1>Congratulations!</h1>

<p>You're now flying with Phalcon. Great things are about to happen!</p>

{% endblock %}