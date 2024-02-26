@foreach($listItem as $item)
    <p>{{ json_encode($item) }}</p>
@endforeach
<h1>Example form</h1>
<form action="{{ route('admin.category.store') }}"method="post">
    <label for="id">ID:</label><br>
    <input type="text" id="id" name="id" value="3"><br>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="Quả"><br>
    
    <label for="icon">Icon:</label><br>
    <input type="text" id="icon" name="icon" value="https://example.com/icons/fruits.png"><br>
    
    <label for="parent_category_id">Parent Category ID:</label><br>
    <input type="text" id="parent_category_id" name="parent_category_id" value=""><br>
    
    <label for="created_at">Created At:</label><br>
    <input type="text" id="created_at" name="created_at" value="2024-02-26 16:19:38"><br>
    
    <label for="updated_at">Updated At:</label><br>
    <input type="text" id="updated_at" name="updated_at" value="2024-02-26 16:19:38"><br><br>
    
    @csrf
    <input type="submit" value="Submit">
</form>
