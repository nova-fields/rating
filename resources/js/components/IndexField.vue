<template>
    <span>
        <i v-for="n in field.max">
            <span v-if="n<=field.value">★</span>
            <span v-else>☆</span>
        </i>
    </span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
