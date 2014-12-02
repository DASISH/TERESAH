@if (PageHelper::showVersionInformation())
    <p><strong>TERESAH {{ Lang::get("views/shared/messages.current_version.commit_id.message") }}</strong> {{ PageHelper::getCurrentCommitId() }} ({{ PageHelper::getCurrentCommitDate() }})</p>
@endif
