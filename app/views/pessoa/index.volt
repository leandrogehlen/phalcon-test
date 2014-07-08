{% extends "layouts/main.volt" %}

{% block content %}
<div align="right">
    {{ link_to("pessoa/new", "Create pessoa") }}
</div>

{{ form("pessoa/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search pessoa</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="id">Id</label>
        </td>
        <td align="left">
            {{ text_field("id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="nome">Nome</label>
        </td>
        <td align="left">
            {{ text_field("nome", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="sobrenome">Sobrenome</label>
        </td>
        <td align="left">
            {{ text_field("sobrenome", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
{% endblock %}
