<template>
  <div>
    <v-calendar :attributes='attrs'></v-calendar>
  </div>
</template>

<style>
    .c-pane-container {
        width: 100%;
    }
</style>

<script>
export default {
    name: 'my-vcalendar',
    data() {
        return {
            attrs: [
                {
                    key: 'today',
                    highlight: {
                        color: '#fafafa',
                        // borderRadius: '1%'
                    },
                    // Just use a normal style
                    contentStyle: {
                        color: '#ff8080',
                    },
                    // Our new popover here
                    popover: {
                    label: 'You just hovered over today\'s date!',
                    },
                    dates: {
                        weekdays: [1],
                        // { start: new Date(2018, 11, 1), end: new Date(2018, 11, 5) },
                        // { start: new Date(2018, 11, 15), span: 5 } // Span is number of days
                    }
                }
            ],
        };
    },
};
</script>