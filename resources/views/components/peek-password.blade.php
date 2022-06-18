<div class="flex justify-center gap-2">
    {{ $slot }}
    <button type="button" class="cursor-pointer" onclick="
    if(this.previousElementSibling.getAttribute('type') === 'password') {
        this.previousElementSibling.setAttribute('type', 'text')
        this.firstElementChild.style.display = 'none'
        this.lastElementChild.style.display = 'block'
    }else if(this.previousElementSibling.getAttribute('type') === 'text') {
        this.previousElementSibling.setAttribute('type', 'password')
        this.firstElementChild.style.display = 'block'
        this.lastElementChild.style.display = 'none'
    }
    ">
    {{-- eye open --}}
    <svg style="display: block" width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 9.005a4 4 0 1 1 0 8 4 4 0 0 1 0-8ZM12 5.5c4.613 0 8.596 3.15 9.701 7.564a.75.75 0 1 1-1.455.365 8.503 8.503 0 0 0-16.493.004.75.75 0 0 1-1.455-.363A10.003 10.003 0 0 1 12 5.5Z" {{ $attributes->merge(['fill' => '#71717a']) }}/></svg>

    {{-- eye close --}}
    <svg style="display: none" width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2.22 2.22a.75.75 0 0 0-.073.976l.073.084 4.034 4.035a9.986 9.986 0 0 0-3.955 5.75.75.75 0 0 0 1.455.364 8.49 8.49 0 0 1 3.58-5.034l1.81 1.81A4 4 0 0 0 14.8 15.86l5.919 5.92a.75.75 0 0 0 1.133-.977l-.073-.084-6.113-6.114.001-.002-6.95-6.946.002-.002-1.133-1.13L3.28 2.22a.75.75 0 0 0-1.06 0ZM12 5.5c-1 0-1.97.148-2.889.425l1.237 1.236a8.503 8.503 0 0 1 9.899 6.272.75.75 0 0 0 1.455-.363A10.003 10.003 0 0 0 12 5.5Zm.195 3.51 3.801 3.8a4.003 4.003 0 0 0-3.801-3.8Z" {{ $attributes->merge(['fill' => '#71717a']) }}/></svg>
    </button>
</div>
