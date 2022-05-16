<template>
    <span class="error-message">{{ message }}</span>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: ''
        }
    }
}
</script>
