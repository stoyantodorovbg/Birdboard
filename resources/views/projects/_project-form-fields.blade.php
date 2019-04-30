@csrf
<div class="field mb-6">
    <label class="text-sm mb-2 block" for="title">
        Title
    </label>
    <input class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
           name="title"
           type="text"
           value="{{ isset($project) ? $project->title : '' }}">
</div>
<div class="field mb-6">
    <label class="text-sm mb-2 block"
            for="description">
        Description
    </label>
    <textarea class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
              name="description">{{ isset($project) ? $project->description : '' }}</textarea>
</div>
@include('partials.validation-errors')
