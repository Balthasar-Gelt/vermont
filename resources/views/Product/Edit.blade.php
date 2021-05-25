<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between content-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>

            <a href="{{ route('products.create') }}" class="cursor-pointer ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Add') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">

        @if ($errors->any())
            <div class="max-w-7xl mx-auto space-y-6 sm:px-6 lg:px-8 mb-5 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf

            <input name="_method" type="hidden" value="PATCH">

            <div class="max-w-7xl mx-auto space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white px-4 py-5 overflow-hidden shadow-xl sm:rounded-lg sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Product Information') }}</h3>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                                    <input value="{{$product->name}}" type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 clone-parent">
                                    <label for="category" class="block text-sm font-medium text-gray-700">{{ __('Categories') }}</label>

                                    @if (sizeof( $product->categories ) == 0)
                                        <div class="flex justify-between items-center mb-3 clone-element">
                                            <select name="categories[]" id="categories" class="w-4/5 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                                                <option value="null" />
                                                @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">
                                                            {{ $category->name }}
                                                        </option>
                                                @endforeach
                                            </select>
                                            <div class="w-1/6 text-indigo-600 cursor-pointer delete-element">{{__('Delete')}}</div>
                                        </div>
                                    @else
                                        @foreach ($product->categories as $productCategory)
                                        <div class="flex justify-between items-center mb-3 clone-element">
                                            <select name="categories[]" id="categories" class="w-4/5 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                                                <option value="null" />
                                                @foreach ($categories as $category)

                                                    @if ($category->id == $productCategory->id)
                                                        <option selected="selected" value="{{$category->id}}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{$category->id}}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            <div class="w-1/6 text-indigo-600 cursor-pointer delete-element">{{__('Delete')}}</div>
                                        </div>
                                        @endforeach
                                    @endif

                                </div>

                                <div class="col-span-6">
                                    <a class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 inline-block mt-1 cursor-pointer clone-button">
                                        {{ __('Add') }}
                                    </a>
                                </div>

                                <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                                    <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{$product->description}}</textarea>
                                </div>
                                <div class="col-span-6">
                                    <label for="hash" class="block text-sm font-medium text-gray-700">{{ __('Hash') }}</label>
                                    <input value="{{$product->hash}}" type="text" name="hash" id="hash" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
