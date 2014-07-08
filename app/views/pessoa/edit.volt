{% extends "layouts/main.volt" %}

{% block content %}
{{ form("pessoa/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("pessoa", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit pessoa</h1>
</div>

<table>
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>

{% endblock %}
