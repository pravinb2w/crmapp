<div id="error"></div>
<form id="deal-insert-notes">
    @csrf
    <input type="hidden" name="deal_id" id="deal_id" value="{{ $info->id ?? '' }}">
    <textarea name="notes" id="notes" cols="30" placeholder="Take a note's..." class="form-control" rows="1"></textarea>
    <div  class="text-end mt-3">
        <button type="button" class="btn btn-light me-2" > Discard </button>
        <button type="button" id="deal-notes-submit" onclick="return insert_deal_notes()" class="btn btn-success"> Save </button>
    </div>
</form>