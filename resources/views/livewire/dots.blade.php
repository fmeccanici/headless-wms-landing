<div class="space-x-3 mt-8">
    @for ($i = 0; $i < $amountOfDots; $i++)
        <i class="fa-solid fa-circle scale-150 {{ $i == $selectedDot ? 'text-orange-400' : '' }}"></i>
    @endfor
</div>
