<template>
    <panel-item :field="field">
        <template slot="value">
            <i v-for="n in field.max">
                <span v-if="n<=field.value">★</span>
                <span v-else>☆</span>
            </i>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
