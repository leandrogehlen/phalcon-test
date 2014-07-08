{% extends "layouts/main.volt" %}

{% block content %}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("pessoa/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("pessoa/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Sobrenome</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for pessoa in page.items %}
        <tr>
            <td>{{ pessoa.id }}</td>
            <td>{{ pessoa.nome }}</td>
            <td>{{ pessoa.sobrenome }}</td>
            <td>{{ link_to("pessoa/edit/"~pessoa.id, "Edit") }}</td>
            <td>{{ link_to("pessoa/delete/"~pessoa.id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("pessoa/search", "First") }}</td>
                        <td>{{ link_to("pessoa/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("pessoa/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("pessoa/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    <tbody>
</table>

{% endblock %}
