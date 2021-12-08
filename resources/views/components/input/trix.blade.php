<div class="relative pb-4 bg-white dark:bg-darker-2 focus-within:bg-lightest border border-lighter hover:border-light focus-within:border-light dark:border-darker focus-within:shadow-md dark:focus-within:border-primary transdiv duration-300 rounded-lg">
  <input id="{{ $id }}" type="hidden"  {{ $attributes->except('class') }}>
  <trix-editor input="{{ $id }}" {{ $attributes->only('class')->merge(['class' => 'unreset']) }}"></trix-editor>
</div>