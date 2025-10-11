<template>
    <FilesTable :files :service :folder_id />
</template>

<script setup lang="ts">
import FilesTable from '@/components/explorer/FilesTable.vue';
import ResourcesLayout from '@/layouts/dashboard/ResourcesLayout.vue';

interface File {
    id: number;
    name: string;
    size: number;
    updated_at: string;
}

interface Service {
    id: number;
    name: string;
}

defineProps<{ files: File[]; service: Service, folder_id: number }>();

defineOptions({ layout: ResourcesLayout });
</script>
