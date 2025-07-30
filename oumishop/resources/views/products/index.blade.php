@if($products->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
@endif
@endsection