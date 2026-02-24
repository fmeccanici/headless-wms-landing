<template>
    <div class="m-2">
        <div class="bg-gray-200 p-10 rounded-xl">
            <pre v-for="line in this.lines">{{ line }}</pre>
        </div>
    </div>

</template>

<script>
export default {
    name: "HttpRequest",
    props: ['lines']
}
</script>

<style scoped>

</style>
