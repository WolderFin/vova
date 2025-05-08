<script>
    const Modal = new HystModal({
        linkAttributeName: "data-hystmodal",
    });
</script>
@include('modal.city')
@include('modal.singin')
@include('modal.singup')
@include('modal.create')
@include('modal.updateCities')
@include('modal.createCities')
@include('modal.updateCategories')
@include('modal.createCategories')
@include('modal.updateAds')
<script src="{{ asset('js/city.js') }}"></script>
