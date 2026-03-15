import { Link } from '@inertiajs/react';
import { Edition } from '@/types';
import moment from 'moment';

export default function RaceItemList({ edition }: { edition: Edition }) {

    return (
        <Link
            href={route('home.races.editions.show', [edition.race.slug, moment(edition.start_date, 'YYYY-MM-DD').format('Y')])}
            className="block rounded-lg border bg-card p-3 transition-colors hover:bg-accent/40"
        >
            <div className="flex gap-3">
                <div className="h-16 w-16 shrink-0 overflow-hidden rounded-md border bg-background">
                    <img className="h-full w-full object-cover" src={edition.race.image ?? '/images/logo.png'} alt="" />
                </div>
                <div className="min-w-0 flex-1">
                    <div className="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">
                        <h5 className="text-base font-semibold leading-tight">{edition.race.name}</h5>
                        {edition.start_date === edition.end_date ? (
                            <small className="text-muted-foreground">{moment(edition.start_date, 'YYYY-MM-DD').format('D/M ')}</small>
                        ) : (
                            <small className="text-muted-foreground">
                                {moment(edition.start_date, 'YYYY-MM-DD').format('D/M ')} - {moment(edition.end_date, 'YYYY-MM-DD').format('D/M ')}
                            </small>
                        )}
                    </div>
                    <p className="mt-1 text-sm text-muted-foreground">{edition.distances.join(' - ')}</p>
                    <small className="text-xs uppercase tracking-wide text-muted-foreground">{edition.race.discipline.name}</small>
                </div>
            </div>
        </Link>
    );
}
