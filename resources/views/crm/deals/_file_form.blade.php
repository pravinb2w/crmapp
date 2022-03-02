<div id="error"></div>
<form id="deal-insert-files" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="deal_id" id="deal_id" value="{{ $info->id ?? '' }}">
    <input type="file" name="deal_file" required>
    <div  class="text-end mt-3">
        <button type="button" class="btn btn-light me-2" > Discard </button>
        <button type="button" id="deal-files-submit" onclick="return insert_deal_files()" class="btn btn-success"> Save </button>
    </div>
</form>