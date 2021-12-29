<template>
    <div
        class="d-flex align-items-center justify-content-center loading"
    >
        <div
            class="spinner-border text-light"
            style="width: 3rem; height: 3rem;"
            role="status"
            aria-hidden="true"></div>
    </div>
</template>

<script>
export default {
    name: "LoadingComponent"
}
</script>

<style scoped>
.loading {
    position: fixed;
    z-index: 1000;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    background-color: rgba(0, 0, 0, .7);
}
</style>
