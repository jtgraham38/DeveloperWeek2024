<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
</head>
<body style="background-color: darkslategray; color:cornsilk;">

@foreach($project->entities as $entity)

<div style="border: 1px solid cornsilk; border-radius: 0.35rem; margin-bottom: 2rem;">

<div style="padding: 0.5rem; border-bottom: 1px solid cornsilk;"><h1>{{ $entity->display_name }}</h1></div>

<details style="padding: 1rem; border-bottom: 1px solid cornsilk;">
<summary style="color: red;"><h2 style="display: inline;">CREATE a {{ $entity->singular_name }}.</h2></summary>
<article>
    <h3>POST <span style="border-bottom: 1px dashed gray;">https://@{{ domain_name }}/api/{{ $entity->multiple_name }}</span></h3>
    <p>Submit a POST request with JSON of the following format in the body to <span style="color: red;">CREATE</span> a {{ $entity->singular_name }}.</p>
    <pre style="border: 1px solid darkgray; background-color: lightgray; border-radius: 0.2rem; color: darkcyan; padding: 0.25rem;">
{
    "first_name": "string_value",
    "last_name": "string_value",
    "email": "string_value",
    "role": "int_value"
}</pre>
    </article>
</details>

<details style="padding: 1rem; border-bottom: 1px solid cornsilk;">
    <summary style="color: blue;"><h2 style="display: inline;">GET all {{ $entity->multiple_name }}.</h2></summary>
    <article>
        <h3>GET <span style="border-bottom: 1px dashed gray;">https://@{{ domain_name }}/api/{{ $entity->multiple_name }}</span></h3>
        <p>Submit a GET request to <span style="color: blue;">GET</span> an index of {{ $entity->multiple_name }}.</p>
    </article>
</details>

<details style="padding: 1rem; border-bottom: 1px solid cornsilk;">
    <summary style="color: blue;"><h2 style="display: inline;">GET a {{ $entity->singular_name }}.</h2></summary>
    <article>
        <h3>GET <span style="border-bottom: 1px dashed gray;">https://@{{ domain_name }}/api/{{ $entity->multiple_name }}/&lt;{{ $entity->singular_name }}_id&gt;</span></h3>
        <p>Submit a GET request to <span style="color: blue;">GET</span> a specific {{ $entity->singular_name }}.</p>
    </article>
</details>

<details style="padding: 1rem; border-bottom: 1px solid cornsilk;">
    <summary style="color: lime;"><h2 style="display: inline;">UPDATE a {{ $entity->singular_name }}.</h2></summary>
    <article>
        <h3>PUT/PATCH <span style="border-bottom: 1px dashed gray;">https://@{{ domain_name }}/api/{{ $entity->multiple_name }}/&lt;{{ $entity->singular_name }}_id&gt;</span></h3>
        <p>Submit a PUT/PATCH request with JSON of the following format in the body to <span style="color: lime;">UPDATE</span> a {{ $entity->singular_name }}.  It need not contain every key listed, but it may not contain keys other than those listed.</p>
        <pre style="border: 1px solid darkgray; background-color: lightgray; border-radius: 0.2rem; color: darkcyan; padding: 0.25rem;">
{
    "first_name": "string_value",
    "last_name": "string_value",
    "email": "string_value",
    "role": "int_value"
}</pre>
    </article>
</details>

<details style="padding: 1rem; border-bottom: 1px solid cornsilk;">
    <summary style="color: orange;"><h2 style="display: inline;">DELETE a {{ $entity->singular_name }}.</h2></summary>
    <article>
        <h3>DELETE <span style="border-bottom: 1px dashed gray;">https://@{{ domain_name }}/api/{{ $entity->multiple_name }}/&lt;{{ $entity->singular_name }}_id&gt;</span></h3>
        <p>Submit a DELETE request to <span style="color: orange;">DELETE</span> a specific {{ $entity->singular_name }}.</p>
    </article>
</details>
</div>
@endforeach

</body>
</html>