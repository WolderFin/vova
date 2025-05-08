<script>
    const Modal = new HystModal({
        linkAttributeName: "data-hystmodal",
    });
</script>
@include('component.modal.city')
@include('component.modal.singin')
@include('component.modal.singup')
@include('component.modal.create')
<script src="{{ asset('js/city.js') }}"></script>
