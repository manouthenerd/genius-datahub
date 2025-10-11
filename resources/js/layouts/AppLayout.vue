<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { CheckCircleIcon} from 'lucide-vue-next';

import {useAlertStore} from '@/stores/alert'

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const alert = useAlertStore();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Alert id="alert" :class="alert.isOn ? 'right-1' : 'right-[-25rem]'" class="table-shadow z-[999] min-w-[340px] max-w-[365px] fixed top-3  border-l-4 border-l-green-500 bg-green-50">
            <CheckCircleIcon class="h-4 w-4 fill-green-500" />
            <AlertTitle>Succès</AlertTitle>
            <AlertDescription class="text-green-800 font-bold">
                {{ alert.message }}
            </AlertDescription>
        </Alert>

        <slot />
    </AppLayout>
</template>

<style scoped>
    #alert {
        transition: all .5s ease;
    }
</style>