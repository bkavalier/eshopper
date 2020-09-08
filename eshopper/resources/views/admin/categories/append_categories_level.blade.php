<div class="control-group">
    <label class="control-label">Select Category Level</label>
    <div class="controls">
        <select name="parent_id">
              <option value="0">Main Category</option>
              @if(!empty($getCategories))
              	@foreach($getCategories as $category)
              	<option value="{{ $category['id'] }}">{{ $category['category_name'] }}
              		@if(!empty($category['subcategories']))
              			@foreach($category['subcategories'] as $subcategory)
              			<option vlaue="{{ $subcategory['id'] }}">&nbsp;&raquo;&nbsp;{{$subcategory['category_name']}}
              			@endforeach
              		@endif
              	@endforeach
              @endif
        </select>
    </div>
</div>
