using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack
{
    interface IObservable<T>
    {
        IDisposable Subscribe(IObserver<T> observer);
    }
}
