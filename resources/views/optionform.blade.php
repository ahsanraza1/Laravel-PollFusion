<form action="{{ url('/poll/options/create') }}" method="POST">
    @csrf
<br>
    <div>
        <!-- <label for="poll_name">Option Text:</label> -->
        <input type="text" name="poll_id" id="poll_id" value="{{$pollid}}" required>
    </div>
    <div>
        <!-- <label for="poll_name">Option Text:</label> -->
        <input type="text" name="poll_id" id="poll_id" value="{{}}" required>
    </div>
    <div>
        <label for="poll_name">Option Text:</label>
        <input type="text" name="option_txt" id="option_txt" required>
    </div>

    <!-- <div>
        <label for="number_of_options">Number of Options:</label>
        <input type="number" name="options" id="number_of_options" required>
    </div> -->

    <div>
        <button type="submit">Create option</button>
    </div>
</form>