{{-- File Upload Component --}}
{{-- Usage: @include('components.file-upload', ['id' => 'student_card', 'label' => 'Student Card', 'accept' => '.pdf', 'maxSize' => '5MB']) --}}
@props(['id' => 'file', 'label' => 'Upload File', 'accept' => '.pdf,.jpg,.png', 'maxSize' => '5MB', 'required' => true])

<div x-data="{
    fileName: '',
    fileSize: '',
    isDragging: false,
    isUploaded: false,
    progress: 0,
    error: '',
    handleFile(file) {
        const maxBytes = parseInt('{{ $maxSize }}') * 1024 * 1024;
        const accepted = '{{ $accept }}'.split(',');
        const ext = '.' + file.name.split('.').pop().toLowerCase();

        if (!accepted.some(a => a.trim() === ext)) {
            this.error = 'Invalid file type. Accepted: {{ $accept }}';
            return;
        }
        if (file.size > maxBytes) {
            this.error = 'File too large. Max: {{ $maxSize }}';
            return;
        }

        this.error = '';
        this.fileName = file.name;
        this.fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        this.simulateUpload();
    },
    simulateUpload() {
        this.progress = 0;
        this.isUploaded = false;
        const interval = setInterval(() => {
            this.progress += Math.random() * 30 + 10;
            if (this.progress >= 100) {
                this.progress = 100;
                this.isUploaded = true;
                clearInterval(interval);
            }
        }, 200);
    },
    removeFile() {
        this.fileName = '';
        this.fileSize = '';
        this.isUploaded = false;
        this.progress = 0;
        this.error = '';
        this.$refs.input.value = '';
    }
}" class="w-full">
    <label class="block text-sm font-medium text-white/70 mb-2">
        {{ $label }}
        @if($required)<span class="text-neon-pink">*</span>@endif
    </label>

    {{-- Drop Zone --}}
    <div x-show="!fileName"
         @dragover.prevent="isDragging = true"
         @dragleave.prevent="isDragging = false"
         @drop.prevent="isDragging = false; handleFile($event.dataTransfer.files[0])"
         :class="isDragging ? 'border-neon-cyan bg-neon-cyan/5' : 'border-white/10 hover:border-white/20'"
         class="border border-dashed rounded p-6 text-center cursor-pointer transition-all duration-200"
         @click="$refs.input.click()">
        <i class="fa-solid fa-cloud-arrow-up text-2xl text-white/20 mb-2"></i>
        <p class="text-sm text-white/40 mb-1">Drag & drop or <span class="text-neon-cyan">browse</span></p>
        <p class="text-xs text-white/25">{{ strtoupper(str_replace('.', '', $accept)) }} — Max {{ $maxSize }}</p>
    </div>

    {{-- Hidden Input --}}
    <input type="file" x-ref="input" accept="{{ $accept }}" id="{{ $id }}" name="{{ $id }}"
           @change="handleFile($event.target.files[0])" class="hidden">

    {{-- File Preview --}}
    <div x-show="fileName" style="display:none;"
         class="border border-white/10 rounded p-3 flex items-center gap-3"
         :class="error ? 'border-red-500/30' : (isUploaded ? 'border-neon-cyan/30' : 'border-white/10')">
        {{-- Icon --}}
        <div class="w-10 h-10 rounded shrink-0 flex items-center justify-center"
             :class="error ? 'bg-red-500/10 text-red-400' : 'bg-neon-cyan/10 text-neon-cyan'">
            <i :class="error ? 'fa-solid fa-triangle-exclamation' : 'fa-solid fa-file-pdf'" class="text-sm"></i>
        </div>

        {{-- Info --}}
        <div class="flex-1 min-w-0">
            <p class="text-sm text-white/70 truncate" x-text="fileName"></p>
            <p class="text-xs text-white/30" x-text="fileSize"></p>
            {{-- Progress Bar --}}
            <div x-show="!isUploaded && !error" class="mt-1.5 h-1 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full bg-neon-cyan rounded-full transition-all duration-300" :style="'width:' + progress + '%'"></div>
            </div>
        </div>

        {{-- Status / Remove --}}
        <div class="flex items-center gap-2 shrink-0">
            <span x-show="isUploaded" class="text-neon-cyan text-xs"><i class="fa-solid fa-check-circle"></i></span>
            <button type="button" @click="removeFile()" class="text-white/30 hover:text-red-400 transition-colors">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    </div>

    {{-- Error --}}
    <p x-show="error" x-text="error" class="text-xs text-red-400 mt-1.5" style="display:none;"></p>
</div>
