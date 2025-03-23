<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .task { padding: 10px; margin-bottom: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
<h1>Task List</h1>
@foreach ($tasks as $task)
    <div class="task" style="background-color: {{ $task['colorCode'] }};">
        <h3>{{ $task['title'] }}</h3>
        <p>{{ $task['description'] }}</p>
    </div>
@endforeach
</body>
</html>
