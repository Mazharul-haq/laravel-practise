<x-layout>
  <div class="container mx-auto">
    <x-card>
      <table class="w-full table-auto rounded-sm">
        <tbody>
          @unless ($items->isEmpty())
            @foreach ($items as $item)
            <tr class="border-gray-300">
              <td
                class="px-4 py-8 text-lg"
              >
                <a href="/listings/{{ $item->id }} ">
                  {{ $item->title }}
                </a>
              </td>
              <td
                  class="px-4 py-8 text-lg"
              >
                <a
                  href="/listings/{{ $item->id }}/edit"
                  class="text-blue-400 px-6 py-2 rounded-xl"
                  ><i
                    class="fa-solid fa-pen-to-square"
                  ></i>
                  Edit</a
                >
              </td>
              <td
                  class="px-4 py-8 text-lg"
              >
                <form action="/listings/{{ $item->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-500">
                    <i class="fa-solid fa-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          
          @else
          <tr>
            <td>
              <p class="text-center">No Listings Found.</p>
            </td>
          </tr>
          @endunless
        </tbody>
      </table>
    </x-card>
  </div>
</x-layout>