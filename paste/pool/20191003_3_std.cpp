#include <cstdio>
#include <cstring>
#include <iostream>
#include <vector>
#include <algorithm>
using namespace std;
typedef vector<int> VI;
typedef pair<int,int> PII;
#define rep(i,n) for(int i=0;i<n;i++)
#define lson l,m,rt<<1
#define rson m+1,r,rt<<1|1
const int maxn  =  100010;
VI edge[maxn],adj[maxn];
int L[maxn] , R[maxn] , dfn;
int ans[maxn] ;
void dfs(int u,int fa)
{
     L[u] = ++dfn;
     for (auto it: edge[u]) {
        if(it!=fa) dfs(it,u);
     }
     R[u] = dfn;
}
// ~segment tree
int col[maxn<<2];
int sum[maxn<<2];
void pushup(int rt, int l, int r) 
{
    if(col[rt] > 0) {
        sum[rt] = r - l + 1;
    } else if(l == r) {
        sum[rt] = 0;
    } else {
        sum[rt] = sum[rt<<1] + sum[rt<<1|1];
    }
}
void update(int L,int R,int val,int l,int r,int rt)
{
    if(L <= l && r <= R) {
         col[rt] += val;
        // printf("col[%d]=%d\n",rt,col[rt]);
         pushup(rt,l,r);
         return;
    }
    int m = l + r >> 1;
    if( L <= m) update(L,R,val,lson);
    if( R > m)  update(L,R,val,rson);
    pushup(rt,l,r);
}
void solve(int u,int fa) 
{
//  printf("u=%d\n",u);
    //枚举跟u 有关的 所有的操作
    for(auto it:adj[u]) {
  //    printf("%d %d\n",L[*it],R[*it]);
        update(L[it],R[it],1,1,dfn,1);
    }
    //printf("sum = %d\n",sum[1]);
    ans[u] = sum[1];
    for(auto it: edge[u]) {
        if(it!=fa) solve(it,u);
    }
    //清空与u有关的所有操作
    for(auto it:adj[u]) {
        update(L[it],R[it],-1,1,dfn,1);
    }
}
int main()
{
	freopen("tree.in", "r", stdin);
	freopen("tree.out", "w", stdout);
	
    int n,m,u,v,a,b;
    scanf("%d%d",&n,&m);
    rep(i,n-1) scanf("%d%d",&u,&v),edge[u].push_back(v),edge[v].push_back(u);
    rep(i,m)  {
        scanf("%d%d",&a,&b);
        adj[a].push_back(a);
        adj[a].push_back(b);

        adj[b].push_back(a);
        adj[b].push_back(b);
    }
    dfs(1,-1);
   // for(int i=1;i<=n;i++) printf("%d %d\n",L[i],R[i]);
    solve(1,-1);
    rep(i,n) printf("%d ",max(1,ans[i+1])-1);
    return 0;
}
