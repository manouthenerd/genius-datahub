<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';
import { Button } from '@/components/ui/button';
import { Bell } from 'lucide-vue-next';
import { Sheet, SheetContent, SheetHeader, SheetTrigger, SheetTitle, SheetDescription } from '@/components/ui/sheet';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <div class="flex justify-between items-center">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <Sheet>
                    <SheetTrigger>
                        <Button class="mr-4">
                            <Bell />
                        </Button>
                    </SheetTrigger>
                    <SheetContent>
                        <SheetHeader>
                            <SheetTitle>
                                Notifications
                            </SheetTitle>
                            <SheetDescription>
                                Toutes vos notifications seront listées ici.
                            </SheetDescription>
                        </SheetHeader>
                        <div>
                            <p>Hello World</p>
                        </div>
                    </SheetContent>
                </Sheet>
            </div>
            <slot />
        </AppContent>
    </AppShell>
</template>
