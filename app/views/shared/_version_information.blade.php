@if (!PageHelper::showVersionInformation())
    <div class="message info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">{{ Lang::get("views/shared/messages.close") }}</span></button>

        <p><strong>TERESAH {{ Lang::get("views/shared/messages.current_version.commit_id.message") }}</strong> {{ PageHelper::getCurrentCommitId() }} ({{ PageHelper::getCurrentCommitDate() }})</p>
    </div>
    <!-- /message.info.alert-dismissible -->
@endif
