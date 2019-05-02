<template>
    <div class="theme-switcher mr-8">
        <button v-for="theme in themes"
                class="rounded-full w-4 h-4 bg-blue border mr-2 focus:outline-none"
                :class="theme + ' ' + { 'border-accent': selectedTheme == theme }"
                @click="switchTheme(theme)"></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                themes: [
                    'theme-light',
                    'theme-green',
                ],
                selectedTheme: 'theme-light'
            }
        },

        created() {
            this.selectedTheme = localStorage.getItem('theme') || 'theme-light';
        },

        watch: {
            selectedTheme() {
                document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);
                localStorage.setItem('theme', this.selectedTheme);
            }
        },

        methods: {
            switchTheme(theme) {
                this.selectedTheme = theme;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .theme-switcher {
        .theme-light {
            background: #F5F6F9;
        }

        .theme-green {
            background: green;
        }
    }
</style>
