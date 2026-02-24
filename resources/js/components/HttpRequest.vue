<template>
    <div class="border border-blue-500 rounded-md p-1 m-2">
        <h3 class="font-bold">{{ this.request }}</h3>
        <p>{{ this.route }}</p>
    </div>
</template>

<script>
export default {
    name: "HttpRequest",
    props: ['route', 'request']
}
</script>

<style scoped>

</style>
