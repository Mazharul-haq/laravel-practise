{{-- @extends('layout')

@section('content') --}}

<x-layout>

<div class="container mx-auto">
@unless(count($items) == 0)
  <div
    class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
  >
  @foreach ($items as $item)
    <x-listing-card :item="$item" />
  @endforeach
  </div>
@else
  <p>No listing found</p>
@endunless

  <div class="mt-6">
    {{ $items->links() }}
  </div>
</div>



{{-- @endsection --}}
</x-layout>